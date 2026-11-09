===source===
<?php
foreach ($a as &$this) {}
===errors===
Cannot re-assign $this
===php_error===
PHP Fatal error:  Cannot re-assign $this in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 15,
              "end": 17
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "this"
            },
            "span": {
              "start": 22,
              "end": 27
            }
          },
          "by_ref": true,
          "by_ref_span": {
            "start": 21,
            "end": 22
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 29,
              "end": 31
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
