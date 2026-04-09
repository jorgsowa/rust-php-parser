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
                          "end": 28,
                          "start_line": 1,
                          "start_col": 27
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 21,
                    "end": 28,
                    "start_line": 1,
                    "start_col": 21
                  }
                }
              },
              "span": {
                "start": 21,
                "end": 30,
                "start_line": 1,
                "start_col": 21
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
        "end": 31,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31,
    "start_line": 1,
    "start_col": 0
  }
}
