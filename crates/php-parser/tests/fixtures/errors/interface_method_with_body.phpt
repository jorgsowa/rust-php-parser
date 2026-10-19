===source===
<?php interface Foo { public function bar() { echo 'body'; } }
===errors===
Interface function Foo::bar() cannot contain body
===php_error===
PHP Fatal error:  Interface function Foo::bar() cannot contain body in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 16,
              "end": 19
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "bar",
                    "span": {
                      "start": 38,
                      "end": 41
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "String": "body"
                            },
                            "span": {
                              "start": 51,
                              "end": 57
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 46,
                        "end": 58
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 60
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
