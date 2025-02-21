import time

from decorators import timer_decorator, timeout_decorator


@timer_decorator
def example_func(n):
    time.sleep(n)
    print("function executed.")


@timeout_decorator(2)
def example_func2(n):
    time.sleep(n)
    print("function executed.")


if __name__ == '__main__':
    try:
        example_func2(7)
    except TimeoutError as e:
        print(e)
