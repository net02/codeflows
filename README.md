# Codeflows
[Codeflows.io](https://www.codeflows.io/) 2019 programming competition challenges.

## Challenges

### Round 1
1. Weird Faculty, see [specs](./doc/round-2/weirdfaculty.png)
2. Arbitrary Shopping, see [specs](./doc/round-2/arbitraryshopping.png)
3. Number Game, see [specs](./doc/round-2/numbergame.png)
4. Keypad, see [specs](./doc/round-2/keypad.png)
5. Long Break, see [specs](./doc/round-2/longbreak.png)
6. Turnstile, see [specs](./doc/round-2/turnstile.png)

Results: all challenges all green!

### Round 2
1. Least Active Intern, see [specs](./doc/round-2/leastactiveintern.png)
2. Hashing the String, see [specs](./doc/round-2/hashingthestring.png)
3. Lost Signal, see [specs](./doc/round-2/lostsignal.png)
4. Minimum Inversion, see [specs](./doc/round-2/minimuminversion.png)
5. Distinct Walk, see [specs](./doc/round-2/distinctwalk.png)

Results:
1. 10/10 green
2. 1/8 green, 7 red due to wrong answer (WTF?!)
3. 1/11 green, 10 red due to timeout
4. 4/41 green, 37 red due to wrong answer
5. 11/23 green, 12 red due to timeout

## Misc

### Testing
Most challenges come with some test input & output, and can be tested with
`cat test/round-X/challenge/input00X.txt | php src/round-X/challenge.php | diff -u --color -w test/round-X/challenge/output00X.txt -`,
which returns the diff from the expected output, if any.

### TODOs
- [ ] automate running the full "test suite" for any challenge, via shell script
- [ ] enforce resource limits (memory and execution time)
- [ ] add optional resource usage to output, enabled via env variable
