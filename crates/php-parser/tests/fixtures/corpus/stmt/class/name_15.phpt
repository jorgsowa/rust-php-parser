===source===
<?php interface A extends static {}
===errors===
cannot use 'static' as class name
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "A",
          "extends": [
            {
              "parts": [
                "static"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 26,
                "end": 32
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
