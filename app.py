from flask import Flask, request , render_template , Request
import pickle 
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
import pandas as pd

courses = pd.read_pickle('df.pkl')
tfidf_vectorizer = TfidfVectorizer()
tfidf_matrix = tfidf_vectorizer.fit_transform(courses['tags'])
def recommend(input_text):
    input_vector = tfidf_vectorizer.transform([input_text])
    similarity_2 = cosine_similarity(input_vector, tfidf_matrix)
    similar_course_indices = similarity_2.argsort(axis=1)[:, :-1]
    top_n_similar_courses_indices = similar_course_indices.ravel()[-6:][::-1]
    recommendations_df = courses.iloc[top_n_similar_courses_indices][['CourseName', 'University','Difficulty Level','Course Rating','Course URL','Skills','CourseDescription']]
    recommendations_df['Course Rating'] = recommendations_df['Course Rating'].astype(float).round().astype(int)
    

    recommendations_list = recommendations_df.to_dict(orient='records')
    return recommendations_list

app = Flask(__name__)

@app.route("/",methods=['GET','POST'])
def home():
    if request.method == "POST":
        user_input = request.form['user_input']
        recommendations = recommend(user_input)
        return render_template('prediction.html', recommendations=recommendations)
    return render_template('prediction.html')

@app.route('/profilesettings')
def profile_settings():
    return render_template('profilesettings.html')
@app.route('/prediction',methods=['GET','POST'])
def recommendation():
    if request.method == "POST":
        user_input = request.form['user_input']
        recommendations = recommend(user_input)
        return render_template('prediction.html', recommendations=recommendations)
    return render_template('prediction.html')

if __name__ == '__main__' :
    app.debug =True
    app.run()