from flask import Flask, request
app = Flask(__name__)

from video import classify

import cv2

video_file_path = 'video.mp4'
temp_image_file_path = 'temp.png'

@app.route('/', methods=['POST'])
def hello_world():


    print request.files
    
    with open(video_file_path, 'w') as f:
        f.write(request.files.get('video').read())
    
    vidcap = cv2.VideoCapture(video_file_path)
    success,image = vidcap.read()
    count = 0
    max_val = 0.0

    image_paths = []

    while success:  

        if count % 3 == 0:
            # rotate cw
            h, w, _ = image.shape

            if w > h:
                image=cv2.transpose(image)
                image=cv2.flip(image,flipCode=1)

            val = classify(image)
            print val
            max_val = max(max_val, val)


        success,image = vidcap.read()
        # print('Read a new frame: ', success)
        count += 1

    ret = int(max_val * 25)
    ret = min(ret, 10)
    ret = max(ret, 0)
    print "Returning:", str(ret)
    return str(ret)

if __name__ == '__main__':
  app.run(host='0.0.0.0', port=5001, debug=True)