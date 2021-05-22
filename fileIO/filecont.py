if guest == True:
f=open("guestfile.txt","W")
f.write(username,phone,temp)

else:
f=open("userfile.txt","W")
f.write(fullname,phone,temp)


if guest == True:
f=open("guestfile","r")
for line in f
cont=line.split(',')
username=cont[0]
phone=cont[1]
temp=cont[2]

else:
f=open("userfile","r")
for line in f
cont=line.split(',')
fullname=cont[0]
phone=cont[1]
temp=cont[2]