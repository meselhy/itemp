import cv2
from pyzbar import pyzbar



def main():
    camera = cv2.VideoCapture(0)
    ret, frame = camera.read()
    barcode_text=""
    while ret:
        ret, frame = camera.read()
        barcodes = pyzbar.decode(frame)
        for barcode in barcodes:
           x, y , w, h = barcode.rect
           barcode_text = barcode.data.decode('utf-8')
           print(barcode_text)
           cv2.rectangle(frame, (x, y),(x+w, y+h), (0, 255, 0), 2)
        cv2.imshow('Barcode reader', frame)
        if cv2.waitKey(1) and barcode_text!="": #0xFF == 27:
            break
 
    camera.release()
    cv2.destroyAllWindows()

if __name__ == '__main__':
    main()