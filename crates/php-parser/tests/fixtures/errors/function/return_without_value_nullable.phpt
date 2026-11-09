===source===
<?php
function f(): ?int { return; }
===errors===
A function with return type must return a value (did you mean "return null;" instead of "return;"?)
===php_error===
PHP Fatal error:  A function with return type must return a value (did you mean "return null;" instead of "return;"?) in Standard input code on line 2
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
                "Return": null
              },
              "span": {
                "start": 27,
                "end": 34
              }
            }
          ],
          "return_type": {
            "kind": {
              "Nullable": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 21,
                      "end": 24
                    }
                  }
                },
                "span": {
                  "start": 21,
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
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
