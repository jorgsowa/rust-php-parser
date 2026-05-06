===source===
<?php

/**
 * Trait docblock with metadata
 * @psalm-require-extends BaseClass
 */
trait MyTrait {
    public function foo() {}
}

===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": "MyTrait",
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "foo",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 103,
                "end": 127
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * Trait docblock with metadata\n * @psalm-require-extends BaseClass\n */",
            "span": {
              "start": 7,
              "end": 82
            }
          }
        }
      },
      "span": {
        "start": 83,
        "end": 129
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 129
  }
}
