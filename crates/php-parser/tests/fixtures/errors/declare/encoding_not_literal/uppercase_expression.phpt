===source===
<?php
declare(ENCODING=1 + 1);
===errors===
Encoding must be a literal
===php_error===
PHP Fatal error:  Encoding must be a literal in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ENCODING",
              {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 23,
                        "end": 24
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 27,
                        "end": 28
                      }
                    }
                  }
                },
                "span": {
                  "start": 23,
                  "end": 28
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
