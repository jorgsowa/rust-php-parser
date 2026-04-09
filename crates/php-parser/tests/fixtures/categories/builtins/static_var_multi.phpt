===source===
<?php function f() { static $a = 1, $b = 2; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "f",
          "params": [],
          "body": [
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": "a",
                    "default": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 33,
                        "end": 34,
                        "start_line": 1,
                        "start_col": 33
                      }
                    },
                    "span": {
                      "start": 28,
                      "end": 34,
                      "start_line": 1,
                      "start_col": 28
                    }
                  },
                  {
                    "name": "b",
                    "default": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 41,
                        "end": 42,
                        "start_line": 1,
                        "start_col": 41
                      }
                    },
                    "span": {
                      "start": 36,
                      "end": 42,
                      "start_line": 1,
                      "start_col": 36
                    }
                  }
                ]
              },
              "span": {
                "start": 21,
                "end": 44,
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
        "end": 45,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45,
    "start_line": 1,
    "start_col": 0
  }
}
