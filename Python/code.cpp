#include <iostream>
using namespace std;

//this is the starting point of execution
int main(){
    //cout<<"Ayushi";
    //cout<<"Hello World"<<endl;
    //cout<<"Hello World"<<"\n";  //\n refur to next line
    //cout<<"Hello World \n from College"<<endl;  // next line
    //cout<<"Apna college"<<"Hello World"<<endl;    // multi word in single line
    
//int(4 bytes),bool(1 byte),double(8 bytes),float(4 bytes),char(1 bytes)
    //int age=25;
    //cout<<age<<endl;
    //char grade ='A';
    //cout<<grade<<endl;
    //float PI=3.14f;
    //bool isSafe=false;
    //bool isSafe=true;
    //double price =100.99;
    //cout << PI <<endl;
    //cout<<isSafe<<endl; //true -> 1 & false ->0

//type casting
    //char grade = 'A'; //65 and a-97 ASCII value
    //int value = grade;
    //cout<<value<<endl;

    //double price = 100.99;
    //int newPrice = (int)price;
    //cout<<newPrice<<endl;

    //int age;
    //cout<<"Enter the age:";
    //cin>>age;
    //cout<<"Your age is:"<<age<<endl;

//Operators
    //Arithmetic(+,-,*,/,%)
    // int a=5,b=10;
    //int b=10; //or
    // int sum=a+b;
    //cout<<sum<<endl;
    // cout<<"Sum ="<<(a+b)<<endl;
    // cout<<"difference ="<<(a-b)<<endl;
    // cout<<"product ="<<(a*b)<<endl;
    // cout<<"division ="<<(a/b)<<endl;
    // cout<<"module ="<<(a%b)<<endl;

    // int a=11,b=5;
    // cout <<(5/2)<<endl;

    // int a=5;
    // double b=2;
    // cout<<(a/b)<<endl;
    // cout <<(5/(double)2)<<endl; // we can type caste the value

    // int ans =(5/(double)2);
    // cout<<ans<<endl;

    //Relational Operator(<,<=,>,>=,==,!=) (it will return ture or false)
    // cout<<(3<5)<<endl;// true->1
    // cout<<(3>5)<<endl;//false->0
    // cout<<(3<=5)<<endl;//true->1
    // cout<<(3>=5)<<endl;//false->0
    // cout<<(3==5)<<endl;//true->0
    // cout<<(3!=5)<<endl;//false->1

    //Logical operator(OR(||),AND(&&),NOT(!))
    // cout<<!(3<1)<<endl;
    // cout<<((3<1)||(3<5))<<endl;
    // cout<<((3>1)||(3<2))<<endl;

//sum of 2 numbers
    // int a,b;
    // cout<<"enter a:";
    // cin>>a;//syntax 
    // cout<<"enter b:";
    // cin>>b;
    // int sum =a+b;
    // cout<<"sum="<<sum<<endl;

    //Unary operators(increment++,decrement--)
    // int a=10;
    // int b=a++;//kaam ,update
    //     //int b=++a;//update,kaam
    //     //int b=a--;
    // cout<<b<<endl;//10
    // cout<<a<<endl;//11

    //a--(a=a-1)kaam,update
    //--a(a=a-1)update,kaam
    // int a=10;
    // int b=a--;//kaam ,update
    //     //int b=--a;//update,kaam
    //     //int b=a--;
    // cout<<"b="<<b<<endl;
    // cout<<"a="<<a<<endl;

//conditional statements(n>=0)positive,(n<0)negative
    //if else condition

    // int n=-45;
    // if(n>=0){
    //     cout<<"n is positive\n";
    // }else{
    //     cout<<"n is negative\n";
    // }
    
    // int age;
    // cout<<"enter age:";
    // cin>>age;
    // if(age>=18){
    //     cout<<"you can vote\n";
    // }else{
    //     cout<<"you can't vote\n";
    // }

    //n%2==0(used for odd and even)
    // int n;
    // cout<<"enter number:";
    // cin>>n;
    // if(n%2==0){
    //     cout<<"Even\n";
    // }else{
    //     cout<<"Odd\n";
    // }

    //if-else if-else

    // int marks;
    // cout<<"enter marks:";
    // cin>>marks;
    // if(marks>=90){
    //     cout<<"A\n";
    // }else if(marks>=80 && marks<90){
    //     cout<<"B\n";
    // }else{
    //     cout<<"C\n";
    // }

    //Find character lower or uppercase
    // char ch;
    // cout<<"enter char:";
    // cin>>ch;
    // if(ch>='a' && ch<='z'){
    //     cout<<"lowercase\n";
    // }else{
    //     cout<<"uppercase\n";
    // }
                //OR
    //using ASCII value 
    // char ch;
    // cout<<"enter character:";
    // cin>>ch;
    // if(ch>=65 && ch<=90){
    //     cout<<"uppercase\n";
    // }else{
    //     cout<<"lowercase\n";
    // }
    
    //Ternary statement(single line code)condition?stt1:strr2;
    // int n=-45;
    // cout<<(n>=0? "positive":"negative")<<endl;

    //loops(while,do-while,for)
    //Q. Print numbers 1 to 5
    // int count=0;
    // while(count<=10){
    //     cout<<count<<" ";
    //     count++;
    // }
    // cout<<endl;

    //Q. print no 1 to n
    // int n=20;
    // int count=1;
    // while(count<=n){
    //     cout<<count<<" ";
    //     count++;
    // }
    // cout<<endl;

    //infinite loop
    // int n=20;
    // int count=1;
    // while(count<=n){
    //     cout<<count<<" ";
    // }
    // cout<<endl;

    //variable names stores in meaningful words, it will prefer it
    // int n=50;
    // int i=1;
    // while(i<=n){
    //     cout<<i<<" ";
    //     i++;
    // }
    // cout<<endl;

    //for loop
    //syntax for(initialisation;conndition;updation){//work}
    // int n=3;
    // for(int i=1;i<=n;i++){
    //     cout<<i<<" ";
    // }
    // cout<<endl;

    // int n=10;
    // for(int i=1;i<=n;i=i+2){   //or i++
    //     cout<<i<<" ";
    // }
    // cout<<endl;

    //Q.sum of numbers from 1 to n.
    // int n=10;
    // int sum=0;
    // for(int i=1;i<=n;i++){
    //     sum += i;
    // }
    // cout<<"sum="<<sum<<endl;

    // int n=10;
    // int sum=0;
    // for(int i=1;i<=n;i++){     //1+2+3+4+5->15
    //     sum += i;
    //     if(i==5){
    //         break;  //it is an keywords
    //     }
    // }
    // cout<<"sum="<<sum<<endl;

    //Q. sum of all Odd numbers from 1 to N
            //n%2==0 (even condition)
            //n%2!=0 (odd condition)
    // int n=10;
    // for(int i=1;i<=n;i++){
    //     if(i%2 !=0){
    //         cout<<i<<" ";
    //     }
    // }
    // cout<<endl;

    //oddSum=0
    // int n=10;
    // int oddSum=0;
    // for(int i=1;i<=n;i++){
    //     if(i%2 !=0){
    //         oddSum+=i;
    //     }
    // }
    // cout<<"OddSum ="<<oddSum<<endl;

    //do-while loop
    //syntax  do{cond...}while(cond..)
        // while(3>5){ //first check condeiton and run
        //     cout<<"Hello World!\n";
        // }
    // it will first run the code after check conditon
    // do{
    //     cout<<"Hello World\n";
    // }while(3>5);

    // int n=10;
    // int i=1;
    // do{
    //     cout<<i<<" ";
    //     i++;
    // }while(i<=n);
    // cout<<endl;

    //Q. Check if a number is prime or not
        //prime numbers comes in 1& n table.
        //non-prime is 4,6,8,10,9
        //n%i==0    (loop work 2 to n-1)
    // int n=7;
    // bool isPrime=true;
    // for(int i=2;i<=n-1;i++){
    //     if(n%i==0){  //non=prime
    //         isPrime=false;
    //         break;
    //     }
    // }
    // if(isPrime==true){
    //     cout<<"prime no\n";
    // }else{
    //     cout<<"non-prime no\n";
    // }
    // isPrime -> true -> prime
    // isPrime -> false -> non prime
                    //OR
    // int n=14;
    // bool isPrime=true;

    // for(int i=2;i+i<=n;i++){
    //     if(n%i==0){
    //         isPrime=false;
    //         break;
    //     }
    // }
    // if(isPrime==true){
    //     cout<<"prime no\n";
    // }else{
    //     cout<<"non prime no\n";
    // }

    //nested loops       //syntax  for(){for(){})}
    // for(int i=1;i<=5;i++){
    //     cout<<"*****"<<endl;
    // }

    // int x=10;
    // for (int i=1;i<=x;i++){
    //     cout<<"*";
    // }
    // cout<<endl;

    //i is iteration
    // for(int i=1;i<=5;i++){  //line
    //     int m=5;
    //     for (int i=1;i<=m;i++){
    //         cout<<"*";
    //     }
    //     cout<<endl;
    // }

    // int n=10; //row
    // for(int i=1;i<=n;i++){  //line
    //     int m=5; //colum
    //     for (int i=1;i<=m;i++){
    //         cout<<"*";
    //     }
    //     cout<<endl;
    // }

    // int n=10; //row
    // for(int i=1;i<=n;i++){  //line
    //     int m=5; //colum
    //     for (int j=1;j<=m;j++){
    //         cout<<"*";
    //     }
    //     cout<<endl;
    // }

    //Q.Sum of all numbers from 1 to N which are divisible by 3.
    // int n;
    // int totalSum=0;
    // cout<<"Enter the value N:";
    // cin>>n;
    // for(int i=1;i<=n;i++){
    //     int temp=i;
    //     while(temp>0){
    //         temp=-3;
    //     }
    //     if(temp==0){
    //         totalSum+=i;
    //     }
    // }
    // cout<<"totalSum:"<<totalSum<<endl;
    
    //Q.Print Fsactorial of a number N.
    // int n;
    // int factorial=1;
    // cout<<"Enter a positive integer:";
    // cin>>n;
    // if(n<0){
    //     cout<<"not factorial";
    // }else{
    //     for(int i=1;i<=n;++i){
    //         factorial*=i;
    //     }
    //     cout<<"factorial "<<n<<"="<<factorial<<endl;
    // }

//Patterns
    // for patterns used for loop (while/d0-while)not mostly used
    //nested loop has 2 types 1) outer loop(n times run(1 to n - means no's print)) 2) inner loop(1 single row)  (means loop under loop)
    
    //square pattern
    //easy with no of pattern is n=4 
    // int n=4;
    // for(int i=1;i<=n;i++){ //outer
    //     for(int j=1;j<=n;j++){ //inner
    //         cout<<j <<" ";
    //     }
    //     cout<<endl;
    // }

    // int n=4;
    // for(int i=1;i<=n;i++){
    //     for(int j=1;j<=n;j++){
    //         cout<<"*";
    //     }
    //     cout<<endl;
    // }

    // int n=4;
    // for(int i=0;i<n;i++){   // or i<=n-1 to start print from 0
    //     for(int j=0;j<n;j++){
    //         cout<<"* ";       // after * space for spacing in run time code
    //     }
    //     cout<<endl;
    // }

    // int n=6;
    // for(int i=0;i<n;i++){
    //     char ch='A';
    //     for(int j=0;j<n;j++){ //inner start=> line start
    //         cout<<ch;
    //         ch=ch+1;   //char + int 
    //         cout<<" ";
    //     }
    //     cout<<endl;
    // }

    //n=3 (outner loop run n times)(inner loop run n no's each line n times)
    // int n=3;
    // int num=1;
    // for(int i=0;i<n;i++){
    //     for(int j=0;j<n;j++){
    //         cout<<num<<" ";
    //         num++;
    //     }
    //     cout<<endl;
    // }
    // cout<<"after pattern:"<<num<<endl;//10

    //using character
    // int n=3;
    // char ch='A';
    // for(int i=0;i<n;i++){
    //     for(int j=0;j<n;j++){
    //         cout<<ch<<" ";
    //         ch++;
    //     }
    //     cout<<endl;
    // }
    // cout<<"after pattern:"<<ch<<endl;//10

    //triangle pattern
    // easy with stars n=4
        //outer loop (lines 0 to n-1)
        //inner loop (i+1 stars to print   1 to i+1   or  0 to i  (i+1))
    // int n=4;
    // for(int i=0;i<n;i++){  //n
    //     for(int j=0;j<i+1;j++){  //i+1
    //         cout<<"* ";
    //     }
    //     cout<<endl;
    // }

    //easy with numbers n=4
        //outer line (lines n times)
        //inner line (i+1  times run)
    // int n=4;
    // for(int i=0;i<n;i++){
    //     for(int j=0;j<i+1;j++){
    //         cout<<(i+1)<<" ";   // i+1 is used to calcalute the no of rows by increment
    //     }
    //     cout<<endl;
    // }

    //character triangle 
    // int n=4;
    // char ch='A';
    // for(int i=1;i<=n;++i){
    //     for(int j=1;j<=i;++j){
    //         cout<<ch<<" ";   
    //     }
    //     ch++;    //row wise the character will increase by it
    //     cout<<endl;
    // }

    //tringle n=4
    // int n=4;
    // for(int i=0;i<=n;i++){
    //     for(int j=1;j<=i+1;j++){
    //         cout<<j<<" ";
    //     }
    //     cout<<endl;
    // }

    //reverse tringle n=4
    //int n=4;
    // for(int i=n;i>0;i--){   //backword loop
    //    cout<<i<<endl;
    // }

    // for(int i=0;i<n;i++){
    //     for(int j=i+1;j>0;j--){
    //         cout<<j<<" ";
    //     }
    //     cout<<endl;
    // }

    //Floyd's triangle pattern with numbers n=4
    // int n=4;
    // int num=1;
    // for(int i=0;i<n;i++){
    //     for(int j=i+1;j>0;j--){ //backwards ->i+1
    //         cout<<num<<" ";
    //         num++;
    //     }
    //     cout<<endl;
    // }

    //character triangle pattern print
    // int n=4;
    // char ch='A';
    // for(int i=0;i<n;i++){
    //     for(int j=i+1;j>0;j--){ //backwards ->i+1
    //         cout<<ch<<" ";
    //         ch++;
    //     }
    //     cout<<endl;
    // }

    //inverted triangle pattern 
    //reverse numbers n=4    // in it there will be 2 loops used(multiple inner loops)
    // int n=4;
    // for(int i=0;i<n;i++){
    //     //spaces
    //     for(int j=0;j<i;j++){  //i times
    //         cout<<" ";
    //     }
    //     //nums
    //     for(int j=0;j<n-i;j++){
    //         cout<<(i+1);
    //     }
    //     cout<<endl;
    // }   

    //inverted pirament
    // int n=4;
    // for(int i=0;i<n;i++){
    //     //spaces
    //     for(int j=0;j<i;j++){  //i times
    //         cout<<" ";
    //     }
    //     //nums
    //     for(int j=0;j<n-i;j++){
    //         cout<<(i+1)<<" ";
    //     }
    //     cout<<endl;
    // }     

    //character inverted
    // int n=4;
    // char ch='A';
    // for(int i=0;i<n;i++){
    //     //spaces
    //     for(int j=0;j<i;j++){  //i times
    //         cout<<" ";
    //     }
    //     //nums
    //     for(int j=0;j<n-i;j++){
    //         cout<<ch;
    //         ch++;
    //     }
    //     cout<<endl;
    // }    

    //pyramid pattern n=4  //in it there will be 3 loops used
    // int n=4;
    //     //spaces=n-i-1   //it will print spaces" "
    //     //num1   all line (1 to i+1) go  cout<<j   
    //     //num2   j=0 to i (i times) runs it will go backwords  or i to 1       // it is an back words loop
    // for(int i=0;i<n;i++){
    //     //spaces  :n-i-1
    //     for(int j=0;j<n-i-1;j++){
    //         cout<<" ";
    //     }
    //     //num1 :i+1
    //     for(int j=1;j<=i+1;j++){
    //         cout<<j;                                                  1
    //     }                                                            121
    //     //num2                                                      12321
    //     for(int j=1;j>0;j--){                                      1234321
    //         cout<<j;
    //     }
    //     cout<<endl;
    // }      //error not running

    //Hollow Diamond Pattern      n=4
        //spaces   to count *   (n-i-1) times " " spaces
        //spaces   to if(i!=0) count *   i=2*i-1   for" " spaces
        //spaces "*" (i+1)
        //spaces "*"4(i!=n-1)      //2(n-i)-5
    // int n=4;
    // //top
    // for(int i=0;i<n;i++){
    //     //spaces
    //     for(int j=0;j<n-i-1;j++){
    //         cout<<" ";
    //     }
    //     cout<<"*";
    //     if(i!=0){
    //         //spaces
    //         for(int j=0;j<2*i-1;j++){
    //             cout<<" ";
    //         }
    //         cout<<"*";
    //     }      //hollow patter print means top part
    //     cout<<endl;
    // }
    // //bottom
    // for(int i=0;i<n-1;i++){   //0 to n-2
    //     //spaces
    //     for(int j=0;j<i+1;j++){
    //         cout<<" ";
    //     }
    //     cout<<"*";
    //     if(i!=n-2){
    //         //spaces
    //         for(int j=0;j<2*(n-i)-5;j++){
    //             cout<<" ";
    //         }
    //         cout<<"*";
    //     }
    //     cout<<endl;
    // }

    //Butterfly Pattern n=4
    // *      *
    // **    **
    // ***  ***
    // ********
    // ********
    // ***  ***
    // **    **
    // *      *
    
//Functions
    //Syntax:  returnType printHello(){    cout<<"Hello"}
    



    return 0;
}
//g++ code.cpp 
//./a.exe  

//Boilerplate Code -comment