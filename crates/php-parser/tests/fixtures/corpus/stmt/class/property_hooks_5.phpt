===source===
<?php
class Test {
    public $prop {
        public public get;
        protected get;
        private get;
        abstract static get;
        readonly get;
    }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Cannot use the public modifier on a property hook
Cannot use the public modifier on a property hook
Cannot use the protected modifier on a property hook
duplicate 'get' hook
Cannot use the private modifier on a property hook
duplicate 'get' hook
Cannot use the abstract modifier on a property hook
Cannot use the static modifier on a property hook
duplicate 'get' hook
Cannot use the readonly modifier on a property hook
duplicate 'get' hook
Non-abstract property hook must have a body
Non-abstract property hook must have a body
Non-abstract property hook must have a body
Non-abstract property hook must have a body
Non-abstract property hook must have a body
===errors >=8.4===
Cannot use the public modifier on a property hook
Cannot use the public modifier on a property hook
Cannot use the protected modifier on a property hook
duplicate 'get' hook
Cannot use the private modifier on a property hook
duplicate 'get' hook
Cannot use the abstract modifier on a property hook
Cannot use the static modifier on a property hook
duplicate 'get' hook
Cannot use the readonly modifier on a property hook
duplicate 'get' hook
Non-abstract property hook must have a body
Non-abstract property hook must have a body
Non-abstract property hook must have a body
Non-abstract property hook must have a body
Non-abstract property hook must have a body
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot use the public modifier on a property hook in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Test",
            "span": {
              "start": 12,
              "end": 16
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
                "Property": {
                  "name": {
                    "name": "prop",
                    "span": {
                      "start": 30,
                      "end": 35
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
                        "start": 46,
                        "end": 64
                      }
                    },
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 73,
                        "end": 87
                      }
                    },
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 96,
                        "end": 108
                      }
                    },
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 117,
                        "end": 137
                      }
                    },
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 146,
                        "end": 159
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 23,
                "end": 165
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 167
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 167
  }
}
