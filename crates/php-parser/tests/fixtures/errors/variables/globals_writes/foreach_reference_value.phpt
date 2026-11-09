===source===
<?php
foreach ($a as &$GLOBALS) {}
===errors >=8.1===
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
===php_error >=8.1===
PHP Fatal error:  $GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax in Standard input code on line 2
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
              "Variable": "GLOBALS"
            },
            "span": {
              "start": 22,
              "end": 30
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
