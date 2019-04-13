import os


class General:

    def sortActivityLog(self, logs):
        sortedList = []
        for eachLog in logs:
            if eachLog not in sortedList:
                sortedList.append(eachLog)
        return sortedList

    def isFileEmpty(self, path):
        return os.stat(path).st_size == 0
