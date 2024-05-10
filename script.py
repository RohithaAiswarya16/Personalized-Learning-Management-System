import sys
import json
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
if __name__ == "__main__":
    input_data = sys.argv[1]
    output_list = recommend(input_data)
    print(json.dumps(output_list))