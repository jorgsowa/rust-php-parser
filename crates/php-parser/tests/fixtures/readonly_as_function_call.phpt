===source===
<?php function readonly() {} readonly();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "readonly",
            "span": {
              "start": 15,
              "end": 23
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "readonly"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 29,
                      "end": 37
                    }
                  }
                },
                "span": {
                  "start": 29,
                  "end": 37
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 29,
            "end": 39
          }
        }
      },
      "span": {
        "start": 29,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
