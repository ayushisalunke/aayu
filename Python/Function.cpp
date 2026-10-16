#include <iostream>
using namespace std;

//Function definition
// int printHello(){
//     //cout<<"Hello\n";
//     return 3;
// }

//sum of 2 number
// int sum(int a,int b){
//     int s=a+b;
//     return s;
// }
// double sum(double a,double b){
//     double s=a+b;
//     return s;
// }

//mininmum of 2 nums
// int minoftwo(int a,int b){
//     if(a<b){
//         return a;
//     }else{
//         return b;
//     }
// }

//1) 1 to N 
// int sumN(int n){
//     int sum=0;
//     for(int i=1;i<=n;i++){
//         sum +=i;
//     }
//     return sum;
// }

//2)N factorail
// int factorialN(int n){
//     int fact=1;
//     for(int i=1;i<=n;i++){
//         fact+=i;    //fact=fact*i;
//     }
//     return fact;
// }

//4)pass by value
// int sum(int a,int b){
//     a=a+10;//15
//     b=b+10;//14
// }

//5)sum of digits of numbers
// int sumofDigits(int num){
//     int digSum=0;
//     while(num>0){
//         int lastDig=num%10;
//         num/=10;
//         digSum+=lastDig;
//     }
//     return digSum;
// }

//6)Binomial coefficent
// int factorial(int n){
//     int fact=1;
//     for(int i=1;i<=n;i++){
//         fact+=i;
//     }
//     return fact;
// }
// int nCr(int n,int r){
//     int fact_n=factorial(n);
//     int fact_r=factorial(r);
//     int fact_nmr=factorial(n-r);
//     return fact_n / (fact_r * fact_nmr);
// }

//7)decimal to binary
// int decToBinary(int decNum){
//     int ans=0,pow=1;
//     while(decNum>0){
//         int rem = decNum %2;
//         decNum /=2;
//         ans+=(rem*pow);
//         pow+=10;
//     }
//     return ans; //binary form
// }

//8)Binary to Decimal
// int bintodecimal(int binNum){
//     int ans =0,pow=1;
//     while(binNum>0){
//         int rem=binNum%10;
//         ans += rem*pow;
//         binNum /= 10;
//         pow+= 2;
//     }
//     return ans; //decimal form
// }

//

int main(){
    //function call/invoke
    // int val = printHello();  //to call the function
    // cout<<"val="<<val<<endl;
    // int a=10;
    // int b=5;
    // cout<<"hello\n";

    //Parameters
    // cout<<sum(10.99,5.65)<<endl;

    // cout<<"min="<<minoftwo(5,3)<<endl;

    //1)Calculate sum of numbers from 1 to N.
    //cout<<sumN(5)<<endl;
    //cout<<sumN(10)<<endl;
 
    //2)Calculate N factorial
    // cout<<factorialN(4)<<endl;
    // cout<<factorialN(5)<<endl;
    
    //3)function in memory
    //4)pass by value/reference  // sent the original value  / it will sent duplicate value of the store value
    // int a=5,b=4;
    // cout<<sum(a,b)<<endl;
    // cout<<a<<endl;
    // cout<<b<<endl;

    //5)calculate sum of  digits of a number.    //num%10 =>reminder => digit     //num=num/10
    //cout<<"sum="<<sumofDigits(2356)<<endl;
    
    //6)calculate nCr binomial coefficient for n & r
    // int n=6,r=3;
    // cout<<nCr(n,r)<<endl;

    //Waf to check if a number is prime or not.
    //Waf to print all prime numbers from 2 to N.
    //wAF TO PRINT nth Fibonacci.

    //7)Decimal to binary
    // int decNum=50;
    // cout<<decToBinary(decNum)<<endl;   //output is wrong
    // for(int i=1;i<=10;i++){
    //     cout<<decToBinary(i)<<endl;
    // }     //ans no come 10101 is output but no coming


    //8)Binary to Decimal
    //cout<<bintodecimal(1010)<<endl;  //10

    //9)

    return 0;
}