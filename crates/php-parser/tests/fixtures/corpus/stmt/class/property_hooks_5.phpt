===config===
min_php=8.4
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
===errors===
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
===php_error===
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
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "is_final": false,
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
                      "is_final": false,
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
                      "is_final": false,
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
                      "is_final": false,
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
                      "is_final": false,
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
