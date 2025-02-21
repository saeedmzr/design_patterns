import threading
import time


def timer_decorator(func):
    def wrapper(*args, **kwargs):
        start_time = time.time()  # Record the start time
        result = func(*args, **kwargs)  # Call the original function
        end_time = time.time()  # Record the end time
        print(f"{func.__name__} took {end_time - start_time:.4f} seconds to execute.")
        return result
    return wrapper


def timeout_decorator(max_time):
    def decorator(func):
        def wrapper(*args, **kwargs):
            def target():
                try:
                    result[0] = func(*args, **kwargs)
                except Exception as e:
                    exception[0] = e

            # Initialize result and exception holders
            result = [None]
            exception = [None]

            # Create and start the thread
            thread = threading.Thread(target=target)
            thread.start()

            # Wait for the thread to finish or timeout
            thread.join(timeout=max_time)

            # Check if the thread is still alive (timed out)
            if thread.is_alive():
                raise TimeoutError(f"Function {func.__name__} exceeded maximum execution time of {max_time} seconds")

            # If an exception occurred in the thread, re-raise it
            if exception[0] is not None:
                raise exception[0]

            # Return the result
            return result[0]

        return wrapper

    return decorator