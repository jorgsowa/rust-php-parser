===source===
<?php
interface I {
    protected $b { get; }
}
===errors <=8.3===
Property in interface cannot be protected or private
'property hooks' requires PHP 8.4 or higher
===errors >=8.4===
Property in interface cannot be protected or private
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Property in interface cannot be protected or private in Standard input code on line 3
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
                    "name": "b",
                    "span": {
                      "start": 34,
                      "end": 36
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected"
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
                        "start": 39,
                        "end": 43
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 24,
                "end": 45
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
