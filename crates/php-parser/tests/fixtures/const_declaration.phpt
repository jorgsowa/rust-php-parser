===source===
<?php const PI = 3.14; const APP_NAME = 'MyApp';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "PI",
              "span": {
                "start": 12,
                "end": 14
              }
            },
            "value": {
              "kind": {
                "Float": 3.14
              },
              "span": {
                "start": 17,
                "end": 21
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 21
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 22
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "APP_NAME",
              "span": {
                "start": 29,
                "end": 37
              }
            },
            "value": {
              "kind": {
                "String": "MyApp"
              },
              "span": {
                "start": 40,
                "end": 47
              }
            },
            "attributes": [],
            "span": {
              "start": 29,
              "end": 47
            }
          }
        ]
      },
      "span": {
        "start": 23,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
