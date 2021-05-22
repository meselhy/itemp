if guest == True:
f=open("guestfile.txt","W")
f.write(username,phone,temp)

else:
f=open("userfile.txt","W")
f.write(fullname,phone,temp)