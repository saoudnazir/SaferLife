from general import General
from LoadDB import LoadDB
from os.path import dirname, join


'''g = General()
name = ["saoud","huy"]
paths = [join(dirname(__file__),"demo.jpg"),join(dirname(__file__),"huy.jpeg")]
ids = [1,2]
g.generateLocalDB(name,g.encodeImages(paths),ids)'''

db = LoadDB()
faces , names, ids = db.loadofflineDB()
print(ids,names,faces)