===config===
min_php=8.0

===source===
<?php
function foo(\Foo\Bar|\Foo\Bar $x) { }

===errors===
Duplicate type '\Foo\Bar' in union type
===php_error===
PHP Fatal error:  Duplicate type Foo\Bar is redundant in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 15,
              "end": 18
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 37,
                  "end": 39
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Foo",
                            "Bar"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 19,
                            "end": 27
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 27
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Foo",
                            "Bar"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 28,
                            "end": 36
                          }
                        }
                      },
                      "span": {
                        "start": 28,
                        "end": 36
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 36
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 19,
                "end": 39
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
