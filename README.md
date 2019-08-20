# Poker
## Initl Requirement
Task A
Create a function that will generate a random hand of 5 standard playing cards.
The hand of cards must be returned in the format: array('2c', '6d', 'as', 'jh', '10c');
For this test, we are looking for elegant readable code.

Task B
Create a function that will return a boolean result as to whether the hand of cards returned by the above function contains a 'straight' or 'straight flush'.
For this test we are looking for as few code characters as possible (Code elegance is not required). 
It has been done with as few as 61 characters, but more commonly between 100-225 chars - the lower the better.

Notes
- Aces are high AND low.
- The #10 cards are 3 characters (10h, 10c, 10s, 10d)

Reference
- Straight : http://en.wikipedia.org/wiki/List_of_poker_hands#Straight
- Straight Flush : http://en.wikipedia.org/wiki/List_of_poker_hands#Straight_flush

## Todo
1. layout
2. ~~two pairs / flush /more rules~~ (Done)
3. Play Texas

## Demo
http://www.bobsyd.com/demo/poker/

## Setup
* docker-compose 
* enter container
* composer install / npm install / npm run dev
