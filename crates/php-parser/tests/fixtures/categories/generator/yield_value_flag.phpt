===source===
<?php function g() { yield 1; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "g",
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 27,
                          "end": 28
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 21,
                    "end": 28
                  }
                }
              },
              "span": {
                "start": 21,
                "end": 30
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
