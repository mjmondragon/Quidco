# Quidco
Service that fetches an animated gif for a given search term or random gif

Add the API_KEY header API_DEMO to the HTTP request to have access.

## Search endpoint
**Path:** /v1/gifs/search
**Description:** Search of GIFs for a word or phrase.

|Request params|Example |
|:--------------|--------|
|**q:** *string*  Search query term or phrase.| banana |
|**length:** integer The maximum number of records to return. Default 25 | 20 |

#### Sucessful Response (200)
>Gif Object[]

## Random endpoint
**Path:** /v1/gifs/random
**Description:** Returns a completely random GIF.

#### Sucessful Response (200)
>Gif Object
