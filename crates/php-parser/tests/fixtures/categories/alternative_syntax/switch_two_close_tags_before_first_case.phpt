===source===
<?php switch ($a): ?>
<?php ?>
<?php case 1: endswitch;
===errors===
Only one ';' may precede the first case of a switch
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '?>', expecting endswitch (T_ENDSWITCH) or case (T_CASE) or default (T_DEFAULT) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";", expecting "endswitch" or "case" or "default" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Switch": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 14,
              "end": 16
            }
          },
          "cases": [
            {
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 42,
                  "end": 43
                }
              },
              "body": [],
              "span": {
                "start": 37,
                "end": 44
              }
            }
          ],
          "uses_alternative": true
        }
      },
      "span": {
        "start": 6,
        "end": 55
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55
  }
}
