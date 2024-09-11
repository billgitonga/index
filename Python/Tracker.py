import phonenumbers
from phonenumbers import geocoder

phone_number1 = phonenumbers.parse("+254707446604")
phone_number2 = phonenumbers.parse("+254770628215")
phone_number3 = phonenumbers.parse("+254721761191")

print("\nPhone Number locations:")
print(geocoder.description_for_numbers(phone_number1,"en"))
print(geocoder.description_for_numbers(phone_number2,"en"))
print(geocoder.description_for_numbers(phone_number3,"en"))