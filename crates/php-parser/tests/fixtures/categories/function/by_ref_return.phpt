===source===
<?php function &getRef() { global $x; return $x; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "getRef",
          "params": [],
          "body": [
            {
              "kind": {
                "Global": [
                  {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 34,
                      "end": 36,
                      "start_line": 1,
                      "start_col": 34
                    }
                  }
                ]
              },
              "span": {
                "start": 27,
                "end": 38,
                "start_line": 1,
                "start_col": 27
              }
            },
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 45,
                    "end": 47,
                    "start_line": 1,
                    "start_col": 45
                  }
                }
              },
              "span": {
                "start": 38,
                "end": 49,
                "start_line": 1,
                "start_col": 38
              }
            }
          ],
          "return_type": null,
          "by_ref": true,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 50,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50,
    "start_line": 1,
    "start_col": 0
  }
}
