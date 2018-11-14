
# Hyperparameters
RANDOM_STATE = 0
EPOCHS = 10000
EPOCHS_HYPEROPT = 500
kernel = 'rbf'

import cPickle as pickle

from prep_data import load_data
import sklearn
from sklearn.svm import SVR

def train_model(save_model=True):

    data, labels, means, stds = load_data()

    data, labels = sklearn.utils.shuffle(data, labels)

    validation_index = int(data.shape[0] * 0.1)

    val_data = data[:validation_index]
    val_labels = labels[:validation_index]

    train_data = data[validation_index:,]
    train_labels = labels[validation_index:]

    model = SVR(max_iter=10000)

    model.fit(train_data, train_labels)
    # print val_data.shape, val_labels.shape
    # print train_data.shape, train_labels.shape

    pred = model.predict(val_data)
    print sklearn.metrics.mean_absolute_error(val_labels, pred)


    if save_model:
        pickle.dump(model, open('model.p', 'wb'))

def load_model():
    return pickle.load(open('model.p', 'rb'))


def test_model():

    model = load_model()

    data, labels, means, stds = load_data()

    data, labels = sklearn.utils.shuffle(data, labels)

    validation_index = int(data.shape[0] * 0.1)

    val_data = data[:validation_index]
    val_labels = labels[:validation_index]

    train_data = data[validation_index:,]
    train_labels = labels[validation_index:]

    pred = model.predict(val_data)
    print sklearn.metrics.mean_absolute_error(val_labels, pred)


    for i in range(1000):

        print "Image", i
        print "Train:", val_labels[i],"Val:", pred[i]








if __name__ == '__main__':

    train_model()
    # test_model()
