===source===
<?php function gen() { yield 1; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "gen",
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
                          "start": 29,
                          "end": 30
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 23,
                    "end": 30
                  }
                }
              },
              "span": {
                "start": 23,
                "end": 31
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
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
