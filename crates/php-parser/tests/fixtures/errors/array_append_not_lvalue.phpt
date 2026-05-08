===source===
<?php $arr[];
===errors===
cannot use [] for reading
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "index": null
            }
          },
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 13
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 13
  }
}
===php_error===
PHP Fatal error:  Cannot use [] for reading in Standard input code on line 1
