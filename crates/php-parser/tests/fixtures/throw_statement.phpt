===source===
<?php throw new Exception('Something went wrong');
===ast===
{
  "stmts": [
    {
      "kind": {
        "Throw": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "Exception"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 16,
                      "end": 25
                    }
                  }
                },
                "span": {
                  "start": 16,
                  "end": 25
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "String": "Something went wrong"
                      },
                      "span": {
                        "start": 26,
                        "end": 48
                      }
                    }
                  },
                  "span": {
                    "start": 26,
                    "end": 48
                  }
                }
              ]
            }
          },
          "span": {
            "start": 12,
            "end": 49
          }
        }
      },
      "span": {
        "start": 6,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
