import cv2
import numpy as np
import dlib
from video_helpers import *
from prep_data import *
from train import *

detector = dlib.get_frontal_face_detector()
predictor = dlib.shape_predictor('shape_predictor_68_face_landmarks.dat')

data, labels, means, stds = load_data()
model = load_model()

def imToolsResize(image, width):
    (h, w) = image.shape[:2]
    r = width / float(w)
    dim = (width, int(h * r))
    return cv2.resize(image, dim)


def processImage(image):

    image = imToolsResize(image, 500)
    gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)

    # detect faces in the grayscale image
    rects = detector(gray, 1)

    # loop over the face detections
    for (i, rect) in enumerate(rects):
        # determine the facial landmarks for the face region, then
        # convert the landmark (x, y)-coordinates to a NumPy array
        shape = predictor(gray, rect)
        shape = shape_to_np(shape)
        shape = shape[:66, :]

        landmarks = convert_landmarks(shape)

        return landmarks

        # Fuck this
        left_eye_i, left_eye_j = FACIAL_LANDMARKS_68_IDXS['left_eye']
        max_y = np.max(shape[left_eye_i:left_eye_j, 1])
        min_y = np.min(shape[left_eye_i:left_eye_j, 1])

        print min_y, max_y

        
        # visualize all facial landmarks with a transparent overlay
        output = visualize_facial_landmarks(image, shape)
        
        return output
    return image

def classify(frame):
  landmarks = processImage(frame).flatten()

  if landmarks.shape[0] != 132:
    return 0

  landmarks = doNormalization(landmarks, means, stds)

  pred = model.predict(landmarks)

  return pred




if __name__ == '__main__':
  # Create a VideoCapture object and read from input file
  # If the input is the camera, pass 0 instead of the video file name
  cap = cv2.VideoCapture(0)
   
  # Check if camera opened successfully
  if (cap.isOpened()== False): 
    print("Error opening video stream or file")
   
  # Read until video is completed
  while(cap.isOpened()):
    # Capture frame-by-frame
    ret, frame = cap.read()
    if ret == True:
   
      # Display the resulting frame
      print classify(frame)

      cv2.imshow('Frame',frame)
   
      # Press Q on keyboard to  exit
      if cv2.waitKey(100) & 0xFF == ord('q'):
        break
   
    # Break the loop
    else: 
      break
   
  # When everything done, release the video capture object
  cap.release()
   
  # Closes all the frames
  cv2.destroyAllWindows()