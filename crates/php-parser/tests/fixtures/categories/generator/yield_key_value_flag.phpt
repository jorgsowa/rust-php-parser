===source===
<?php function g() { yield $k => $v; }
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
                      "key": {
                        "kind": {
                          "Variable": "k"
                        },
                        "span": {
                          "start": 27,
                          "end": 29
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "v"
                        },
                        "span": {
                          "start": 33,
                          "end": 35
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 21,
                    "end": 35
                  }
                }
              },
              "span": {
                "start": 21,
                "end": 37
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
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
