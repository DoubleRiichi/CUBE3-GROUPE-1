

with open("./database/test_data/movies.sql", "r") as fp, open("./movies-fix.sql", "w") as out:
    for line in fp:
        split = line.split(");--")
        out.write(split[0] + ");\n")
