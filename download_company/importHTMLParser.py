# import HTMLParser
# import urllib

# urlText = []

# #Define HTML Parser
# class parseText(HTMLParser.HTMLParser):
        
#     def handle_data(self, data):
#         if data != '\n':
#             urlText.append(data)
    

# #Create instance of HTML parser
# lParser = parseText()

# thisurl = "http://www-rohan.sdsu.edu/~gawron/index.html"
# #Feed HTML file into parser
# lParser.feed(urllib.urlopen(thisurl).read())
# lParser.close()
# for item in urlText:
#     print item


import re, urllib

textfile = file('/tmp/depth_1.txt','wt')
print "Enter the URL you wish to crawl.."
print 'Usage  - "http://phocks.org/stumble/creepy/" <-- With the double quotes'
myurl = input("@> ")
for i in re.findall('''href=["'](.[^"']+)["']''', urllib.urlopen(myurl).read(), re.I):
        print i  
        for ee in re.findall('''href=["'](.[^"']+)["']''', urllib.urlopen(i).read(), re.I):
                print ee
                textfile.write(ee+'\n')
textfile.close()