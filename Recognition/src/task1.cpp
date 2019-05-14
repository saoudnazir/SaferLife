#include<iostream>
#include<string.h>

using namespace std;
/*
objective list:
double petrolConsumed 
double milesTravelled 
double milesPerGallons 
double gallons 

alogrithm:
step 1- intialize the variables double in for petrol consumed (in liters),  
        miles travelled, miles per gallon and gallons.
step 2- calculate gallons  trough consumed petrol(in liters) multiplying by given value of gallons .
step 3- get input from the user through cout and cin and store all input values inside variables.
step 4 -calculate the miles per gallons by using divison method.
step 5- set the precision / fixed for the decimal-point notation.
step 5- print out the output for petrol consumed (in liters)
       -miles travelled
       -miles per gallons. */
int main() {

	double petrolConsumed = 0;
	double milesTravelled = 0;
	double milesPerGallons = 0;
	double gallons = petrolConsumed * 0.264179;
	

	cout << "This program reads the numbers of liters of petrol consumed" << endl
		<< "(petrol in liters) and the number of miles travelled by  the " << endl
		<< "car (miles)" << endl << endl;


	cout << "Please enter the number of liters of petrol consumed : ";
	cin >> petrolConsumed;

	cout << "Please enter the number of miles travelled by car:";
	cin >> milesTravelled;
	cout << endl;

	gallons = petrolConsumed * 0.264179;
	milesPerGallons = milesTravelled / gallons;

	cout.precision(3);
	cout  << fixed << endl;
	cout << "Petrol Consumed (in liters):\t\tMiles Travelled:\t\tMiles Per Gallons:"<< endl;
	 cout<< petrolConsumed <<"\t\t\t\t\t"<< milesTravelled << "\t\t\t\t" << milesPerGallons << endl;
	

	system("pause");
	return(0);


}