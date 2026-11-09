===source===
<?php foreach ($a as &$k => $v) {}
===errors===
Key element cannot be a reference
===php_error===
PHP Fatal error:  Key element cannot be a reference in Standard input code on line 1
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
          "key": {
            "kind": {
              "Variable": "k"
            },
            "span": {
              "start": 22,
              "end": 24
            }
          },
          "key_by_ref": true,
          "value": {
            "kind": {
              "Variable": "v"
            },
            "span": {
              "start": 28,
              "end": 30
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 32,
              "end": 34
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
