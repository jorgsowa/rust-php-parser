===source===
<?php function f(): true { return true; }
===errors <=8.1===
'true type' requires PHP 8.2 or higher
===php_error <=8.1===
PHP Fatal error:  Cannot use 'true' as class name as it is reserved in Standard input code on line 1
===ast===
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
                    "Bool": true
                  },
                  "span": {
                    "start": 34,
                    "end": 38
                  }
                }
              },
              "span": {
                "start": 27,
                "end": 39
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "true"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 20,
                  "end": 24
                }
              }
            },
            "span": {
              "start": 20,
              "end": 24
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
