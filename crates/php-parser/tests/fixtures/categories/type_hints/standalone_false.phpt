===source===
<?php function f(): false { return false; }
===php_error <=8.1===
PHP Fatal error:  False can not be used as a standalone type in Standard input code on line 1
===ast >=8.2===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Bool": false
                  },
                  "span": {
                    "start": 35,
                    "end": 40
                  }
                }
              },
              "span": {
                "start": 28,
                "end": 41
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "false"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 20,
                  "end": 25
                }
              }
            },
            "span": {
              "start": 20,
              "end": 25
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
