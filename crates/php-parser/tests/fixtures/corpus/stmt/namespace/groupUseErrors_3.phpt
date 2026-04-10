===source===
<?php
// Extra NS separator
use Foo\{\Bar};
===errors===
expected non-fully-qualified name in group use, found '}'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "Foo",
                  "Bar"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 32,
                  "end": 41
                }
              },
              "alias": null,
              "span": {
                "start": 37,
                "end": 41
              }
            }
          ]
        }
      },
      "span": {
        "start": 28,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
