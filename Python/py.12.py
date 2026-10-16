from tkinter import *
root=Tk()
root.title('Contact No')
root.geometry('400x400')
root.eval('tk::PlaceWindow . center')
l=Label(root,text='Contact Form',font=('times',5,'bold'),bd='5px')
l1=Label(root,text='Yourname:',font=('times',15,'bold'))
l2=Label(root,text='Your Email:',font=('times',15,'bold'))
l3=Label(root,text='Mobial No:',font=('times',15,'bold'))
l4=Label(root,text='Fathername:',font=('times',15,'bold'))
l5=Label(root,text='Date of birth:',font=('times',15,'bold'))

e=Entry(font=('times',15),bd='2px')
e1=Entry(font=('times',15),bd='2px')
e2=Entry(font=('times',15),bd='2px')
e3=Entry(font=('times',15),bd='2px')
e4=Entry(font=('times',15),bd='2px')

b=Button(text='Summit',font='times 15',bd='3px',bg='#bfdcea')
b.place(x=160,y=250)

e.place(x=160,y=50)
e1.place(x=160,y=90)
e2.place(x=160,y=130)
e3.place(x=160,y=170)
e4.place(x=160,y=210)

l.place(x=110,y=0)
l1.place(x=30,y=50)
l2.place(x=30,y=90)
l3.place(x=30,y=130)
l4.place(x=30,y=170)
l5.place(x=30,y=210)

root.mainloop()

