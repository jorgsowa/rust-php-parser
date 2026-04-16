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
expected 'get' or 'set', found 'public'
expected 'get' or 'set', found 'public'
expected 'get' or 'set', found 'protected'
expected 'get' or 'set', found 'private'
expected 'get' or 'set', found 'abstract'
expected 'get' or 'set', found 'static'
expected 'get' or 'set', found 'readonly'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Test",
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
                  "name": "prop",
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
===php_error===
PHP Fatal error:  Cannot use the public modifier on a property hook in Standard input code on line 4
