===source===
<?php
class A { use fn; }
===errors===
expected class name, found 'fn'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'fn' (T_FN), expecting identifier (T_STRING) or namespace (T_NAMESPACE) or \\ (T_NS_SEPARATOR) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "fn" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "fn"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 20,
                        "end": 22
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 16,
                "end": 23
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
