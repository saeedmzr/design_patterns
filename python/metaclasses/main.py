
class TestMeta(type):
    def __new__(cls, name, bases, attrs):

        attrs["test"] = "test added attrs"
        print(f"cls : {cls}")
        print(f"name : {name}")
        print(f"bases : {bases}")
        print(f"attrs : {attrs}")
        return super().__new__(cls,name,bases,attrs)


# class A(metaclass=TestMeta):
#     pass


class Test:
    pass

