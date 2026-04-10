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
                        "end": 34
                      }
                    },
                    "span": {
                      "start": 28,
                      "end": 34
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
                        "end": 42
                      }
                    },
                    "span": {
                      "start": 36,
                      "end": 42
                    }
                  }
                ]
              },
              "span": {
                "start": 21,
                "end": 43
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
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
