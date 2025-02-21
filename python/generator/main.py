def fibonacci():
    a, b = 0, 1
    while True:
        yield a
        a, b = b, a + b


def main(counter):
    fibo_gen = fibonacci()
    for i in range(counter):
        print(next(fibo_gen))

if __name__ == '__main__':
        main(15)