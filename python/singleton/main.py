"""
implement singleton pattern with extends a class with __new__ method that confirms singleton pattern.
"""


class SingletonWithInheritance:
    _instance = None

    def __new__(cls, *args, **kwargs):
        if not cls._instance:
            cls._instance = super().__new__(cls)
        return cls._instance


class MyClass1(SingletonWithInheritance):
    def __init__(self, value):
        self.value = value



"""
implement singleton pattern with override  __new__ directly method that confirms singleton pattern.
"""

class MyClass2:
    _instance = None

    def __new__(cls, *args, **kwargs):
        if not cls._instance:
            cls._instance = super().__new__(cls)
        return cls._instance

    def __init__(self, value):
        self.value = value



"""
implement singleton pattern with meta in parent class.
"""
class SingletonMeta(type):
    _instances = {}

    def __call__(cls, *args, **kwargs):
        if cls not in cls._instances:
            cls._instances[cls] = super().__call__(*args, **kwargs)
        return cls._instances[cls]


class MyClass3(metaclass=SingletonMeta):
    def __init__(self, value):
        self.value = value



"""
implement singleton pattern with decorator pattern.
"""

def singleton(cls):
    instances = {}

    def get_instance(*args, **kwargs):
        if cls not in instances:
            instances[cls] = cls(*args, **kwargs)
        return instances[cls]

    return get_instance


@singleton
class MyClass4:
    def __init__(self, value):
        self.value = value


a = MyClass4(1)
b = MyClass4(2)
print(a.value)
print(b.value)