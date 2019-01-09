# Codeflows
[Codeflows.io](https://www.codeflows.io/) 2019 programming competition challenges.

## Challenges

### Round 1
1. Weird Faculty, see [specs](./doc/weirdfaculty.png)
2. Arbitrary Shopping, see [specs](./doc/arbitraryshopping.png)
3. Number Game, see [specs](./doc/numbergame.png)
4. Keypad, see [specs](./doc/keypad.png)
5. Long Break, see [specs](./doc/longbreak.png)
6. Turnstile, see [specs](./doc/turnstile.png)

## Misc

### Testing
Most challenges come with some test input & output, and can be tested
with `cat test/challenge/input00X.txt | php challenge.php | diff -u --color -w test/challenge/output00X.txt -`,
which returns the diff from the expected output, if any.

### TODOs
- [ ] automate running the full "test suite" for any challenge, via shell script
- [ ] enforce resource limits (memory and execution time)
- [ ] add optional resource usage to output, enabled via env variable
