import numpy as np
import glob
import os
import cv2

import cPickle as pickle

from keras.preprocessing import image

CROP_FACES = True
detection_model_path = 'haarcascade_frontalface_default.xml'

def load_image(image_path, grayscale=False, target_size=None):
    color_mode = 'grayscale'
    if grayscale == False:
        color_mode = 'rgb'
    else:
        grayscale = False
    pil_image = image.load_img(image_path, grayscale, color_mode, target_size)
    return image.img_to_array(pil_image)


def convert_landmarks(landmarks):
    min_x = np.min(landmarks[:, 0])
    max_x = np.max(landmarks[:, 0])
    min_y = np.min(landmarks[:, 1])
    max_y = np.max(landmarks[:, 1])

    x, y, w, h = min_x, min_y, max_x - min_x, max_y - min_y

    # Add some padding
    padding_factor = 0.1
    x -= int(w * padding_factor)
    w += 2 * int(w * padding_factor)

    y -= int(h * padding_factor)
    h += 2 * int(h * padding_factor)

    # cropped = image[y:y+h, x:x+w, :]

    # Scale landmarks
    landmarks = landmarks.astype('float32')
    landmarks[:,0] -= x
    landmarks[:,0] /= (w * 1.)
    
    landmarks[:,1] -= y
    landmarks[:,1] /= (h * 1.)

    return landmarks


def doNormalization(landmarks, means, stds):
    landmarks = landmarks - means
    landmarks = landmarks / stds

    return landmarks


def fetch_data(normalize=True):

    DATASET_SIZE = 48398
    FEATURES_SIZE = 66 * 2

    data = np.zeros((DATASET_SIZE, FEATURES_SIZE))
    labels = np.zeros((DATASET_SIZE, ))

    count = 0
    for patient_id in os.listdir('Images/'):

        patient_file_path = os.path.join('Images/', patient_id)

        for patient_angle in os.listdir(patient_file_path):
            print count
            angle_file_path = os.path.join(patient_file_path, patient_angle)

            for frame in os.listdir(angle_file_path):

                frame_file_path = os.path.join(angle_file_path, frame)
                
                landmarks_file_path = os.path.join('AAM_landmarks', patient_id)
                landmarks_file_path = os.path.join(landmarks_file_path, patient_angle)
                landmarks_file_path = os.path.join(landmarks_file_path, frame)
                landmarks_file_path = landmarks_file_path.replace('.png', '_aam.txt')
                
                # print frame_file_path, landmarks_file_path


                # img = cv2.imread(frame_file_path) #load_image(frame_file_path, grayscale=True)

                # Read landmarks
                landmarks = []
                with open(landmarks_file_path) as f_landmarks:

                    for line in f_landmarks:
                        x, y = map(int, map(float, line.strip().split()))
                        landmarks.append((x, y))

                        # cv2.circle(gray, (x, y), 1, (255,0,0), -1)

                # Read pain scale
                label_file_path = os.path.join('Frame_Labels/PSPI', patient_id)
                label_file_path = os.path.join(label_file_path, patient_angle)
                label_file_path = os.path.join(label_file_path, frame)
                label_file_path = label_file_path.replace('.png', '_facs.txt')

                with open(label_file_path) as f_label:

                    label = float(f_label.read().strip())
                    # label = int((label / 15.0) * 10)

                    # print 'PSPI(out of 10):', label

                landmarks = np.array(landmarks)

                landmarks = convert_landmarks(landmarks)

                data[count, :] = landmarks.flatten()
                labels[count] = label / 15.0

                # print data[count,:]
                # print labels[count]

                count += 1


                # break            
        #     break
        # break
    # print data
    # print labels

    means = np.mean(data, axis=0)
    stds  = np.std(data, axis=0)

    print means.shape, stds.shape

    # Normalize data
    data = data - means
    data = data / stds

    return data, labels, means, stds

def save_data():

    data, labels, means, stds = fetch_data()

    pickle.dump( (data, labels, means, stds), open( "data.p", "wb" ) )

def load_data():

    data, labels, means, stds = pickle.load(open('data.p', 'rb'))

    return data, labels, means, stds


if __name__ == '__main__':

    save_data()
    # data, labels = load_data()