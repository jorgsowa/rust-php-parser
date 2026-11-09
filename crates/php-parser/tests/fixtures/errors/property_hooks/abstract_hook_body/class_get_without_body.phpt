===source===
<?php
abstract class A {
    public $d { get; }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Non-abstract property hook must have a body
===errors >=8.4===
Non-abstract property hook must have a body
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Non-abstract property hook must have a body in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 21,
              "end": 22
            }
          },
          "modifiers": {
            "is_abstract": true,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 36,
                      "end": 38
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
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
                        "start": 41,
                        "end": 45
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 29,
                "end": 47
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}
