===type===
array{name: string, age?: int, ...}
===output===
{
  "kind": {
    "ArrayShape": {
      "fields": [
        {
          "key": "name",
          "optional": false,
          "value_type": {
            "kind": {
              "Named": "string"
            },
            "span": {
              "start": 12,
              "end": 18
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        },
        {
          "key": "age",
          "optional": true,
          "value_type": {
            "kind": {
              "Named": "int"
            },
            "span": {
              "start": 26,
              "end": 29
            }
          },
          "span": {
            "start": 20,
            "end": 29
          }
        }
      ],
      "extra": true
    }
  },
  "span": {
    "start": 0,
    "end": 35
  }
}
