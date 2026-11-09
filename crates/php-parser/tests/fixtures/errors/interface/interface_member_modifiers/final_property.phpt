===source===
<?php
interface I {
    final $d { get; }
}
===errors <=8.3===
Property in interface cannot be final
'property hooks' requires PHP 8.4 or higher
'final properties' requires PHP 8.4 or higher
===errors >=8.4===
Property in interface cannot be final
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error 8.3===
PHP Fatal error:  Cannot use the final modifier on a property in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Property in interface cannot be final in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 30,
                      "end": 32
                    }
                  },
                  "modifiers": {
                    "is_final": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 35,
                        "end": 39
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 24,
                "end": 41
              }
            }
          ],
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
